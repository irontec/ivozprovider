#!/bin/bash
###############################################################################
# apispec-diff.sh
#
# Author: IvozProvider <vozip@irontec.com>
# Date: 2026/09/02
#
###############################################################################
#
# Compare the committed API spec of a REST application between two git
# references and print the differences in a compact, human readable format.
#
# Used while writing the API changelog of a release, as documented in
# doc/dev/RELEASE.md file
#
# Usage: apispec-diff.sh platform [from-ref] [to-ref]
#
# Exit codes:
#   0 - differences found and printed
#   1 - no differences found
#   2 - invalid usage or missing spec
#
###############################################################################

# Keep sort and comm collation consistent
export LC_ALL=C

APP=$1
FROM=$2
TO=$3

if [ -z "$APP" ]; then
    echo "ERROR: Missing application parameter"
    echo
    echo "Usage: $0 <platform|brand|client|user> [from-ref] [to-ref]"
    exit 2
fi

case "$APP" in
    platform|brand|client|user) ;;
    *)
        echo "ERROR: Unknown application '$APP'"
        echo
        echo "Usage: $0 <platform|brand|client|user> [from-ref] [to-ref]"
        exit 2
        ;;
esac

# Move to repository root
cd $(dirname "$(realpath -se "$0")")/..

# Default range: from the last release tag up to the current main branch
if [ -z "$FROM" ]; then
    FROM=$(git describe --tags --abbrev=0 main)
fi
if [ -z "$TO" ]; then
    TO="main"
fi

SPEC="web/rest/$APP/public/apiSpec.json"

for REF in "$FROM" "$TO"; do
    if ! git cat-file -e "$REF:$SPEC" 2>/dev/null; then
        echo "ERROR: $SPEC not found at $REF"
        exit 2
    fi
done

WORKDIR=$(mktemp -d)
trap "rm -rf $WORKDIR" EXIT

git show "$FROM:$SPEC" > "$WORKDIR/old.json"
git show "$TO:$SPEC" > "$WORKDIR/new.json"

# One line per operation: path<TAB>METHOD
JQ_OPERATIONS='
    .paths | to_entries[] | .key as $path
    | .value | to_entries[]
    | "\($path)\t\(.key | ascii_upcase)"
'

# One line per operation parameter: path<TAB>METHOD<TAB>parameter
JQ_PARAMETERS='
    .paths | to_entries[] | .key as $path
    | .value | to_entries[] | .key as $method
    | (.value.parameters // [])[]
    | "\($path)\t\($method | ascii_upcase)\t\(.name)"
'

# One line per model: model
JQ_MODELS='.definitions | keys[]'

# One line per model property: model<TAB>property
JQ_PROPERTIES='
    .definitions | to_entries[] | .key as $model
    | (.value.properties // {} | keys[])
    | "\($model)\t\(.)"
'

extract() {
    jq -r "$2" "$WORKDIR/$1.json" | sort
}

for SET in operations parameters models properties; do
    VARNAME="JQ_$(echo $SET | tr '[:lower:]' '[:upper:]')"
    extract old "${!VARNAME}" > "$WORKDIR/old.$SET"
    extract new "${!VARNAME}" > "$WORKDIR/new.$SET"
    comm -13 "$WORKDIR/old.$SET" "$WORKDIR/new.$SET" > "$WORKDIR/added.$SET"
    comm -23 "$WORKDIR/old.$SET" "$WORKDIR/new.$SET" > "$WORKDIR/removed.$SET"
done

if [ ! -s "$WORKDIR/added.operations" ] && [ ! -s "$WORKDIR/removed.operations" ] \
    && [ ! -s "$WORKDIR/added.parameters" ] && [ ! -s "$WORKDIR/removed.parameters" ] \
    && [ ! -s "$WORKDIR/added.models" ] && [ ! -s "$WORKDIR/removed.models" ] \
    && [ ! -s "$WORKDIR/added.properties" ] && [ ! -s "$WORKDIR/removed.properties" ]; then
    exit 1
fi

# Parameters of brand new operations are already implied by the operation
grep_out_known_operations() {
    local KNOWN=$1
    local INPUT=$2
    if [ -s "$KNOWN" ]; then
        grep -vFf <(cut -f1,2 "$KNOWN") "$INPUT"
    else
        cat "$INPUT"
    fi
}

# Properties of brand new models are printed along with the model itself
properties_of() {
    local MODEL=$1
    local FILE=$2
    awk -F'\t' -v model="$MODEL" '$1 == model {print $2}' "$FILE" | paste -sd, - | sed 's/,/, /g'
}

print_section() {
    local TITLE=$1
    local FILE=$2
    [ -s "$FILE" ] || return 0
    echo "== $TITLE =="
    cat "$FILE"
    echo
}

echo "# $APP API spec diff: $FROM -> $TO"
echo

print_section "ENDPOINTS ADDED" "$WORKDIR/added.operations"
print_section "ENDPOINTS REMOVED" "$WORKDIR/removed.operations"

grep_out_known_operations "$WORKDIR/added.operations" "$WORKDIR/added.parameters" \
    > "$WORKDIR/filtered-added.parameters"
grep_out_known_operations "$WORKDIR/removed.operations" "$WORKDIR/removed.parameters" \
    > "$WORKDIR/filtered-removed.parameters"

print_section "PARAMETERS ADDED" "$WORKDIR/filtered-added.parameters"
print_section "PARAMETERS REMOVED" "$WORKDIR/filtered-removed.parameters"

if [ -s "$WORKDIR/added.models" ]; then
    echo "== MODELS ADDED =="
    while read -r MODEL; do
        echo -e "$MODEL\t$(properties_of "$MODEL" "$WORKDIR/added.properties")"
    done < "$WORKDIR/added.models"
    echo
fi

print_section "MODELS REMOVED" "$WORKDIR/removed.models"

if [ -s "$WORKDIR/added.models" ]; then
    grep -vFf <(cut -f1 "$WORKDIR/added.models") "$WORKDIR/added.properties" \
        > "$WORKDIR/filtered-added.properties"
else
    cp "$WORKDIR/added.properties" "$WORKDIR/filtered-added.properties"
fi
if [ -s "$WORKDIR/removed.models" ]; then
    grep -vFf <(cut -f1 "$WORKDIR/removed.models") "$WORKDIR/removed.properties" \
        > "$WORKDIR/filtered-removed.properties"
else
    cp "$WORKDIR/removed.properties" "$WORKDIR/filtered-removed.properties"
fi

print_section "PROPERTIES ADDED" "$WORKDIR/filtered-added.properties"
print_section "PROPERTIES REMOVED" "$WORKDIR/filtered-removed.properties"

exit 0
