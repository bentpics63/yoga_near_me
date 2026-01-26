#!/bin/bash
# SessionEnd: Log completion, commit work, advance queue

QUEUE_FILE=".claude/task-queue.md"
LOG_FILE=".claude/session-log.md"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📝 SESSION END PROCESSING"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Log session end
echo "- **Session ended**: $TIMESTAMP" >> "$LOG_FILE"

# Check for uncommitted changes
if [ -n "$(git status --porcelain 2>/dev/null)" ]; then
    echo "💾 Committing changes..."
    
    # Generate commit message from current task
    TASK_NAME=$(grep -m1 "^\- \[ \] \*\*Task" "$QUEUE_FILE" | sed 's/.*\*\*Task [0-9]*\*\*: //' | cut -d'—' -f1 | xargs)
    
    git add -A
    git commit -m "Auto-commit: $TASK_NAME [$TIMESTAMP]"
    
    echo "✅ Committed: $TASK_NAME"
    echo "- **Committed**: $TASK_NAME" >> "$LOG_FILE"
else
    echo "ℹ️  No uncommitted changes"
fi

# Clean up WIP state if exists
if [ -f ".claude/wip.md" ]; then
    rm ".claude/wip.md"
    echo "🧹 Cleared WIP state"
fi

# Clean up session state
if [ -f ".claude/session-state.json" ]; then
    rm ".claude/session-state.json"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Session complete. Run 'claude' to start next session."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
