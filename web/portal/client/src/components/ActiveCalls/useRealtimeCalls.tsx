import { useCallback, useEffect, useState } from 'react';
import {
  Calls,
  InputStruct,
  isTryingStruct,
  isUpdateStruct,
  OutputStuct,
  TryingStuct,
  UpdateStuct,
} from './types';
import useWsClient from './useWsClient';

const useRealtimeCalls = (): [boolean, Calls] => {
  const [calls, setCalls] = useState<Calls>({});
  let syncCallsCopy = { ...calls };

  const updateCall = (data: UpdateStuct) => {
    const callId = data['Call-ID'];
    const event = data.Event;

    const newValue = {
      ...syncCallsCopy,
    };

    if (event === 'UpdateCLID') {
      // Update event or party
      setCalls(() => {
        newValue[callId] = {
          ...newValue[callId],
          party: data.Party,
        };

        syncCallsCopy = newValue;
        return newValue;
      });
    } else {
      newValue[callId] = {
        ...newValue[callId],
        event,
      };

      if (event === 'Confirmed') {
        setCalls(() => {
          newValue[callId] = {
            ...newValue[callId],
            time: data.Time,
          };

          syncCallsCopy = newValue;
          return newValue;
        });
      } else if (event === 'Terminated') {
        // _hideRow
        setCalls(() => {
          delete newValue[callId];

          syncCallsCopy = newValue;
          return newValue;
        });
      }
    }
  };

  const createCall = (data: TryingStuct) => {
    const callId = data['Call-ID'];

    const newRow: OutputStuct = {
      id: data.ID,
      callId: callId,
      direction: data.Direction,
      event: data.Event,
      time: data.Time,
      duration: '',
      owner: data.Owner,
      party: data.Party,
    };

    setCalls(() => {
      const newValue = {
        ...syncCallsCopy,
        [callId]: newRow,
      };

      syncCallsCopy = newValue;
      return newValue;
    });
  };

  const onMessage = useCallback((data: InputStruct) => {
    const callId = data['Call-ID'];

    if (isUpdateStruct(data) && syncCallsCopy[callId]) {
      return updateCall(data);
    }

    if (isTryingStruct(data) && data.Event !== 'Terminated') {
      return createCall(data);
    }

    console.log('Ignore update for unknown call', data);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const wsServerUrl = `wss://${document.location.hostname}/wss`;
  const ready = useWsClient<TryingStuct>({
    wsServerUrl,
    onMessage,
  });

  useEffect(() => {
    const interval = setInterval(() => {
      if (Object.keys(syncCallsCopy).length === 0) {
        return;
      }

      const newValue = {
        ...syncCallsCopy,
      };

      const now = Math.round(new Date().getTime() / 1000);

      for (const idx in newValue) {
        let seconds = Math.max(now - newValue[idx].time, 0);

        let minutes = Math.floor(seconds / 60);

        const hours = Math.floor(seconds / 60 / 60);
        if (hours >= 3) {
          delete newValue[idx];
          continue;
        }

        minutes -= hours * 60;
        seconds -= hours * 60 * 60 + minutes * 60;

        const hoursStr = hours > 0 ? `${hours}h ` : '';
        const minutesStr = minutes > 0 ? `${minutes}m ` : '';

        newValue[idx].duration = hoursStr + minutesStr + seconds + 's';
      }

      setCalls(newValue);
    }, 1000);

    return () => clearInterval(interval);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  return [ready, calls];
};

export default useRealtimeCalls;
