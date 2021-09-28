#!/bin/bash

for TEST in $(ls -1 tests/bbs/*test-*.yaml); do
    TESTNAME=$(basename ${TEST%.*})
    bbs --nameserver ${NAMESERVER} -c $TEST -e tests/bbs/environment.yaml -o "results_${TESTNAME}".xml -v || \
    bbs --nameserver ${NAMESERVER} -c $TEST -e tests/bbs/environment.yaml -o "results_${TESTNAME}".xml -v || \
    bbs --nameserver ${NAMESERVER} -c $TEST -e tests/bbs/environment.yaml -o "results_${TESTNAME}".xml -v || true
    sleep 2
done

