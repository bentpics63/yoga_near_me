#!/bin/bash
# SessionStart: Load current task and provide context

QUEUE_FILE=".claude/task-queue.md"
STATE_FILE=".claude/session-state.json"
LOG_FILE=".claude/session-log.md"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 TASK QUEUE STATUS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Show current task
echo ""
echo "🎯 CURRENT TASK:"
sed -n '/^## Current Task/,/^## Queued/p' "$QUEUE_FILE" | head -n -1 | tail -n +2

# Show queued count
QUEUED_COUNT=$(grep -c "^\- \[ \] \*\*Task" "$QUEUE_FILE" || echo "0")
echo ""
echo "📦 Tasks remaining in queue: $QUEUED_COUNT"

# Check for previous session state
if [ -f "$STATE_FILE" ]; then
    echo ""
    echo "💾 PREVIOUS SESSION STATE:"
    cat "$STATE_FILE"
fi

# Check for work-in-progress
if [ -f ".claude/wip.md" ]; then
    echo ""
    echo "⚠️  WORK IN PROGRESS FROM INTERRUPTED SESSION:"
    cat ".claude/wip.md"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "Begin work on current task. Mark complete when done."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Log session start
echo "- **Session started**: $(date '+%Y-%m-%d %H:%M:%S')" >> "$LOG_FILE"
