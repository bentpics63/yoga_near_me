#!/bin/bash
# advance-task.sh: Move completed task to Completed section, advance queue
# Usage: bash .claude/hooks/advance-task.sh

QUEUE_FILE=".claude/task-queue.md"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

# Extract current task line
CURRENT_TASK=$(grep -m1 "^\- \[ \] \*\*Task" "$QUEUE_FILE")

if [ -z "$CURRENT_TASK" ]; then
    echo "No current task found"
    exit 1
fi

# Mark as complete with timestamp
COMPLETED_TASK=$(echo "$CURRENT_TASK" | sed "s/\- \[ \]/- [x] ✅ ($TIMESTAMP)/")

# Get the task number
TASK_NUM=$(echo "$CURRENT_TASK" | grep -o "Task [0-9]*" | grep -o "[0-9]*")

# Remove the current task block (task + its context/criteria lines)
sed -i "" "/^## Current Task/,/^## Queued/{/^\- \[ \] \*\*Task $TASK_NUM\*\*/d}" "$QUEUE_FILE"

# Find next task and move it to Current
NEXT_TASK=$(grep -m1 "^\- \[ \] \*\*Task" "$QUEUE_FILE")

if [ -n "$NEXT_TASK" ]; then
    # Remove from Queued
    sed -i "" "0,/^\- \[ \] \*\*Task/{/^\- \[ \] \*\*Task/d}" "$QUEUE_FILE"
    
    # Add to Current Task section
    sed -i "" "/^## Current Task/a\\
$NEXT_TASK" "$QUEUE_FILE"
fi

# Add completed task to Completed section
sed -i "" "/^## Completed/a\\
$COMPLETED_TASK" "$QUEUE_FILE"

echo "✅ Task $TASK_NUM marked complete"
echo "📋 Queue advanced"
