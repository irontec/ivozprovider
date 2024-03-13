import { useCallback, useEffect, useRef, useState } from 'react';

import {
  Calls,
  InputStruct,
  isTryingStruct,
  isUpdateStruct,
  OutputStuct,
  TryingStuct,
  UpdateStuct,
  WsFilters,
} from '../types';
import useWsClient from './useWsClient';

interface UseRealtimeCallsProps {
  filters?: WsFilters;
}

const useRealtimeCalls = (props: UseRealtimeCallsProps): [boolean, Calls] => {
  const { filters } = props;
  const [calls, setCalls] = useState<Calls>({});
  const syncCallsRef = useRef<Calls>({});
  syncCallsRef.current = { ...calls };

  const updateCall = (data: UpdateStuct) => {
    const callId = data['Call-ID'];
    const event = data.Event;

    const syncCalls = syncCallsRef.current;

    syncCalls[callId] = {
      ...syncCalls[callId],
      event,
    };

    if (event === 'Confirmed') {
      setCalls(() => {
        syncCalls[callId] = {
          ...syncCalls[callId],
          time: data.Time,
        };

        return { ...syncCalls };
      });
    } else if (event === 'Terminated') {
      // hide row
      setCalls(() => {
        delete syncCalls[callId];

        return { ...syncCalls };
      });
    }
  };

  const createCall = (data: TryingStuct) => {
    const callId = data['Call-ID'];

    const newRow: OutputStuct = {
      id: data.ID,
      callId: callId,
      brand: data.Brand,
      direction: data.Direction,
      event: data.Event,
      time: data.Time,
      duration: '',
      company: data.Company,
      caller: data.Caller,
      callee: data.Callee,
      operator: data.Carrier ?? data.DdiProvider ?? '',
    };

    setCalls(() => {
      syncCallsRef.current[callId] = newRow;

      return { ...syncCallsRef.current };
    });
  };

  const onMessage = useCallback((data: InputStruct) => {
    const callId = data['Call-ID'];

    if (isUpdateStruct(data) && syncCallsRef.current[callId]) {
      return updateCall(data);
    }

    if (isTryingStruct(data) && data.Event !== 'Terminated') {
      return createCall(data);
    }

    // eslint-disable-next-line no-console
    console.log('Ignore update for unknown call', data);
  }, []);

  const wsServerUrl = `wss://${document.location.hostname}/wss`;
  const ready = useWsClient<TryingStuct>({
    wsServerUrl,
    onMessage,
    filters,
  });

  useEffect(() => {
    const interval = setInterval(() => {
      const syncCalls = syncCallsRef.current;
      if (Object.keys(syncCalls).length === 0) {
        return;
      }

      const now = Math.round(new Date().getTime() / 1000);

      for (const idx in syncCalls) {
        let seconds = Math.max(now - syncCalls[idx].time, 0);

        let minutes = Math.floor(seconds / 60);

        const hours = Math.floor(seconds / 60 / 60);
        if (hours >= 3) {
          delete syncCalls[idx];
          continue;
        }

        minutes -= hours * 60;
        seconds -= hours * 60 * 60 + minutes * 60;

        const hoursStr = hours > 0 ? `${hours}h ` : '';
        const minutesStr = minutes > 0 ? `${minutes}m ` : '';

        syncCalls[idx].duration = `${hoursStr + minutesStr + seconds}s`;
      }

      setCalls({ ...syncCalls });
    }, 1000);

    return () => clearInterval(interval);
  }, []);

  useEffect(() => {
    if (!ready) {
      setCalls({});
    }
  }, [ready]);

  return [ready, calls];
};

export default useRealtimeCalls;
