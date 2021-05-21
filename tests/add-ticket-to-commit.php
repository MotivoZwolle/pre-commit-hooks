<?php

$test = function(string $name, string $input, string $output) use ($binary) {
    $file = tempnam(sys_get_temp_dir(), 'test-');
    file_put_contents($file, $input);

    $res = exec(sprintf('%s %s', realpath(__DIR__ . '/../scripts/add-ticket-to-commit.sh'), escapeshellarg($file)), $void, $exitCode);
    $actual = file_get_contents($file);

    @unlink($file);

    if ($exitCode !== 0) {
        echo "$name: FAIL, exit code {$exitCode}\n";
        throw new \Exception('Test failed');
    }

    if (trim($actual) !== trim($output)) {
        echo "$name: FAIL, invalid output\n";
        echo <<<END
        Expected output
        =========================================================
        {$output}
        =========================================================

        Actual output
        =========================================================
        {$actual}
        =========================================================
        END;
        throw new \Exception('Test failed');
    }

    echo "$name: OK\n";
};

chdir(__DIR__);

$currentBranch = exec("git rev-parse --abbrev-ref HEAD");
$safeCurrentBranch = escapeshellarg($currentBranch);

try {
    passthru("git checkout -f -B test/aba-123-test {$safeCurrentBranch}");

    $test("Empty message", "", "ABA-123 - ");
    $test("Simple message", "Test 123", "ABA-123 - Test 123");
    $test("Tagged message", "ABA-123 - I am test", "ABA-123 - I am test");
    $test("Wrapped tag", "[ABA-123] I am test", "[ABA-123] I am test");
    $test("Colon tag", "ABA-123: I am test", "ABA-123: I am test");

    passthru("git checkout -f -B test/not-taggable {$safeCurrentBranch}");

    $test("Empty message", "", "");
    $test("Simple message", "Test 123", "Test 123");
    $test("Tagged message", "ABA-123 - I am test", "ABA-123 - I am test");
    $test("Colon tag", "ABA-123: I am test", "ABA-123: I am test");
} catch (Exception $exception) {
    echo "Test failed";
} finally {
    passthru("git checkout {$safeCurrentBranch}");
}
