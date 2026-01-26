# .planning Directory

This folder contains project planning documents, session handoffs, and work-in-progress specs.

## Structure

```
.planning/
├── README.md           # This file
├── handoffs/           # Session summaries with next steps
│   └── YYYY-MM-DD-description.md
├── codebase/           # Codebase analysis docs (if needed)
└── specs/              # Work-in-progress specifications
```

## Handoffs

Each handoff file summarizes a Claude Code session:
- What was completed
- Files created/modified
- Your action items
- Pending tasks
- Context for next session

**Latest handoff:** [handoffs/2025-01-20-platform-setup.md](handoffs/2025-01-20-platform-setup.md)

## How to Use

1. **Before a session:** Check latest handoff for context
2. **After a session:** Review new handoff for action items
3. **Starting work:** Check pending tasks, mark what you've completed

## Note

The `.planning` folder is prefixed with a dot to keep it out of the way in file browsers. It's still tracked by git (unless you add it to .gitignore).
