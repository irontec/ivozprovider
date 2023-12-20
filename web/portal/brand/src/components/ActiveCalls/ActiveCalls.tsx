import { criteriaToArray } from '@irontec/ivoz-ui/components/List/List.helpers';
import useQueryStringParams from '@irontec/ivoz-ui/components/List/useQueryStringParams';
import { Skeleton } from '@mui/material';
import { useDeferredValue, useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useStoreState } from 'store';

import { StyledListContent } from './ActiveCalls.styles';
import ActiveCallsTable from './ActiveCallsTable';
import FilterComponent from './FilterComponent';
import useRealtimeCalls from './useRealtimeCalls';

export default function ActiveCalls(): JSX.Element | null {
  const [ready, calls] = useRealtimeCalls();
  const deferredCalls = useDeferredValue(calls);

  const navigate = useNavigate();
  const queryStringCriteria = useStoreState(
    (state) => state.route.queryStringCriteria
  );
  const targetQueryString = criteriaToArray(queryStringCriteria).join('&');

  const currentQueryParams = useQueryStringParams();
  const currentQuerystring = currentQueryParams.join('&');
  const [prevReqQuerystring, setPrevReqQuerystring] =
    useState<string>(currentQuerystring);

  useEffect(() => {
    // Criteria change listener
    if (targetQueryString === prevReqQuerystring) {
      return;
    }

    if (currentQuerystring === targetQueryString) {
      debugger;

      return;
    }

    setPrevReqQuerystring(targetQueryString);

    let referrer = location.pathname;
    if (targetQueryString) {
      referrer += `?${targetQueryString}`;
    }

    // Change path
    navigate(
      {
        pathname: location.pathname,
        search: targetQueryString,
      },
      {
        state: {
          referrer,
        },
      }
    );
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [targetQueryString]);

  return (
    <StyledListContent>
      <div className='card'>
        {!ready && (
          <Skeleton
            style={{ marginBottom: 20 }}
            variant='rectangular'
            height={42}
          />
        )}
        {ready && (
          <>
            <FilterComponent />
            <ActiveCallsTable calls={deferredCalls} />
          </>
        )}
      </div>
    </StyledListContent>
  );
}
