import { Skeleton } from '@mui/material';
import { useDeferredValue } from 'react';
import { useStoreState } from 'store';

import { queryStringCriteriaToFilters } from './ActiveCalls.helpers';
import { StyledListContent } from './ActiveCalls.styles';
import ActiveCallsTable from './ActiveCallsTable';
import FilterComponent from './FilterComponent';
import useRealtimeCalls from './hooks/useRealtimeCalls';

export default function ActiveCalls(): JSX.Element | null {
  const queryStringCriteria = useStoreState(
    (state) => state.route.queryStringCriteria
  );
  const filters = queryStringCriteriaToFilters(queryStringCriteria);

  const [ready, calls] = useRealtimeCalls({
    filters,
  });
  const deferredCalls = useDeferredValue(calls);

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
