#!/bin/bash

# Create output dir
mkdir -p /opt/irontec/ghpages/

# Regenerate sphinx documentation
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/en -wartemis -woasis -wbleeding -whalliday -Wx -- -D"language=en"
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/es -wartemis -woasis -wbleeding -whalliday -Wx -- -D"language=es"
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/ensingle -wartemis -woasis -wbleeding -whalliday -Wx -- -D"language=en" -b singlehtml
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/essingle -wartemis -woasis -wbleeding -whalliday -Wx -- -D"language=es" -b singlehtml
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/enlatex -wartemis -woasis -whalliday -Wx -- -D"language=en" -b latex
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/eslatex -wartemis -woasis -whalliday -Wx -- -D"language=es" -b latex
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/enepub -wartemis -woasis -whalliday -Wx -- -D"language=en" -b epub
sphinx-versioning build -r artemis doc/sphinx /opt/irontec/ghpages/esepub -wartemis -woasis -whalliday -Wx -- -D"language=es" -b epub

# Generate PDF from latex build
for RELEASE in oasis artemis halliday; do
    for LANG in es en; do
        pushd /opt/irontec/ghpages/${LANG}latex/${RELEASE}
            pdflatex -interaction nonstopmode IvozProvider.tex > /dev/null || true
        popd
    done
done

:

