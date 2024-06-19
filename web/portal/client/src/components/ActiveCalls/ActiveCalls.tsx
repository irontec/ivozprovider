import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useDeferredValue } from 'react';

import ActiveCallsTable from './ActiveCallsTable';
import useRealtimeCalls from './useRealtimeCalls';

export default function ActiveCalls(): JSX.Element | null {
  const [ready, calls] = useRealtimeCalls();

  const deferredCalls = useDeferredValue(calls);

  return (
    <div>
      {!ready && <div>{_('Loading')}</div>}
      {ready && <ActiveCallsTable calls={deferredCalls} />}
    </div>
  );
}
