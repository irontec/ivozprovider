#!/bin/bash

# Create output dir
mkdir -p /opt/irontec/ghpages/

# Regenerate sphinx documentation
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/en -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=en"
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/es -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=es"
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/ensingle -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=en" -b singlehtml
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/essingle -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=es" -b singlehtml
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/enlatex -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=en" -b latex
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/eslatex -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=es" -b latex
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/enepub -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=en" -b epub
sphinx-versioning build -r tempest doc/sphinx /opt/irontec/ghpages/esepub -woasis -wartemis -whalliday -wtempest -wbleeding -Wx -- -D"language=es" -b epub

# Generate PDF from latex build
for RELEASE in oasis artemis halliday tempest; do
    for LANG in es en; do
        pushd /opt/irontec/ghpages/${LANG}latex/${RELEASE}
            pdflatex -interaction nonstopmode IvozProvider.tex > /dev/null || true
        popd
    done
done

:

