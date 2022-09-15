import { useDeferredValue } from 'react';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ActiveCallsTable from './ActiveCallsTable';
import useRealtimeCalls from './useRealtimeCalls';

export default function ActiveCalls(): JSX.Element | null {
  const [ready, calls] = useRealtimeCalls();

  const deferredCalls = useDeferredValue(calls);

  return (
    <div>
      <h3>{_('Active calls')}</h3>
      {!ready && <div>Loading</div>}
      {ready && <ActiveCallsTable calls={deferredCalls} />}
    </div>
  );
}
