# Task Queue Hooks for Claude Code

Autonomous workflow system for running Claude Code sessions without real-time interaction.

## Setup

1. Copy the `.claude/` directory to your project root
2. Make hooks executable: `chmod +x .claude/hooks/*.sh`
3. Edit `.claude/task-queue.md` with your actual tasks
4. Adjust paths in `cache-purge.sh` for your WordPress installation

## How It Works

**SessionStart**: Displays current task, any WIP state from interrupted sessions, and queued task count. Claude knows exactly what to work on.

**SessionEnd**: Auto-commits work with descriptive message, cleans up state, logs completion.

**PostToolUse (CSS)**: Automatically purges LiteSpeed cache when style.css changes. No more forgetting.

**PostToolUseFailure**: Logs failures, suggests recovery approaches, keeps session moving.

**Stop**: Emergency save if session is interrupted. Stashes uncommitted work, creates WIP marker for next session.

## Task Format

```markdown
- [ ] **Task N**: Brief description
  - Context: Files, selectors, relevant info
  - Success criteria: How to know it's done
  - On completion: Any follow-up actions
```

## Advancing the Queue

When Claude completes a task, run:
```bash
bash .claude/hooks/advance-task.sh
```

Or have Claude update `task-queue.md` directly — change `- [ ]` to `- [x]` and move to Completed section.

## Customization

- Edit `settings.json` to add/remove hooks
- Adjust `cache-purge.sh` for your specific caching setup
- Modify `session-start.sh` to include project-specific context

## Files

```
.claude/
├── settings.json          # Hook configuration
├── task-queue.md          # Your task manifest
├── session-log.md         # Auto-populated session history
├── wip.md                 # Created on interrupted sessions
├── session-state.json     # Optional state between sessions
└── hooks/
    ├── session-start.sh
    ├── session-end.sh
    ├── cache-purge.sh
    ├── failure-recovery.sh
    ├── emergency-save.sh
    └── advance-task.sh
```
