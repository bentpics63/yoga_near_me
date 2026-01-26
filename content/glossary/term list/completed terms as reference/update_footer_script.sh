#!/bin/bash

# Script to track which files have been updated
# This script will be used by Claude to process all glossary HTML files

BASE_DIR="/Users/eddieb/Projects/Yoganearme.info/content/glossary/completed terms as reference"

# List of all HTML files (excluding the template)
find "$BASE_DIR" -name "*.html" -not -path "*/GLOSSARY DEFINITION TEMPLATE/*" | sort
