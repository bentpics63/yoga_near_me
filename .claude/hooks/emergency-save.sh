#!/bin/bash
# Stop: Save work-in-progress state on unexpected stop

WIP_FILE=".claude/wip.md"
LOG_FILE=".claude/session-log.md"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

echo ""
echo "🚨 Session stopping — saving work in progress..."

# Create WIP marker
cat > "$WIP_FILE" << EOF
# Work In Progress

**Interrupted**: $TIMESTAMP

## Last Known State
Session was interrupted. Check:
- Git status for uncommitted changes
- Recent file modifications
- Database state if mid-transaction

## Recovery
Next session will detect this file and prompt to resume.
EOF

# Log the interruption
echo "- **⚠️ Session interrupted**: $TIMESTAMP" >> "$LOG_FILE"

# Attempt emergency commit of any changes
if [ -n "$(git status --porcelain 2>/dev/null)" ]; then
    git add -A
    git stash push -m "Emergency stash: interrupted session $TIMESTAMP"
    echo "💾 Changes stashed for recovery"
fi

echo "✅ WIP state saved to $WIP_FILE"
