#!/bin/bash
# PostToolUseFailure: Log failure and provide recovery guidance

LOG_FILE=".claude/session-log.md"
FAILURE_LOG=".claude/failures.log"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')

echo ""
echo "⚠️  Tool failure detected"

# Log the failure
echo "[$TIMESTAMP] Tool failure occurred" >> "$FAILURE_LOG"
echo "- **Tool failure**: $TIMESTAMP" >> "$LOG_FILE"

# Common recovery suggestions
echo ""
echo "Recovery options:"
echo "  1. Retry the operation (transient failures often resolve)"
echo "  2. Check network/API connectivity"
echo "  3. For Supabase: verify connection string and permissions"
echo "  4. For file operations: check path and permissions"
echo ""
echo "If persistent, log details to .claude/failures.log and continue with next subtask"
