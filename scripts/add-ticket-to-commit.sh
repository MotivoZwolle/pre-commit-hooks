#!/bin/bash

FILE="$1"

MESSAGE="$(cat $FILE)"
if [[ "$MESSAGE" = "fixup!*" || "$MESSAGE" == "squash!*" ]]; then
	exit 0;
fi

TICKET="$(git rev-parse --abbrev-ref HEAD | grep -Eo '^(\w+/)?(\w+[-_])?[0-9]+' | grep -Eo '(\w+[-])?[0-9]+' | tr "[:lower:]" "[:upper:]")"
if [[ $TICKET == "" || "$MESSAGE" == "$TICKET -"* || "$MESSAGE" == "$TICKET:"* || "$MESSAGE" == "[$TICKET]"* ]]; then
	exit 0;
fi

echo "$TICKET - $MESSAGE" > $FILE
