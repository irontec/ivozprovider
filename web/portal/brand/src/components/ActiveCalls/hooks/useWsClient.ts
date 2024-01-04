import { useEffect, useState } from 'react';
import { useStoreState } from 'store';

import { WsFilters } from '../types';

type UseWsClientProps<T> = {
  wsServerUrl: string;
  onMessage: (data: T) => void;
  filters?: WsFilters;
};

const useWsClient = <T>(props: UseWsClientProps<T>): boolean => {
  const token = useStoreState((actions) => actions.auth.token);
  const { wsServerUrl, filters, onMessage } = props;
  const filtersStr = JSON.stringify(filters);

  const [ready, setReady] = useState<boolean>(false);

  useEffect(() => {
    // eslint-disable-next-line no-console
    console.log('init socket', wsServerUrl);
    const socket = new WebSocket(wsServerUrl);

    let retries = 0;
    const maxRetries = 5;
    let timeout: NodeJS.Timeout;

    function register() {
      const payload: Record<string, unknown> = {};

      if (filters) {
        payload.register = filters;
      }
      payload.auth = token;

      socket.send(JSON.stringify(payload));
    }

    socket.onmessage = function (event) {
      const payload = event.data;

      switch (payload) {
        case 'Challenge':
          if (retries >= maxRetries) {
            // eslint-disable-next-line no-console
            console.error('Unable to register');
            socket.close();
          } else if (retries === 0) {
            retries++;
            register();
          } else {
            timeout = setTimeout(function () {
              retries++;
              register();
            }, 1000);
          }

          break;

        case 'Subscribing':
          setReady(true);
          break;

        default:
          onMessage(JSON.parse(payload));
      }
    };

    socket.onclose = function (event) {
      if (event.wasClean) {
        // eslint-disable-next-line no-console
        console.log(
          `[ws close] Connection closed cleanly, code=${event.code} reason=${event.reason}`
        );
      } else {
        // e.g. server process killed or network down
        // event.code is usually 1006 in this case
        // eslint-disable-next-line no-console
        console.log('[ws close] Connection died');
      }
    };

    socket.onerror = function (error) {
      // eslint-disable-next-line no-console
      console.error(`[ws error]`, error);
      setReady(false);
    };

    return () => {
      // eslint-disable-next-line no-console
      console.log('socket down');
      if (timeout) {
        clearTimeout(timeout);
      }

      setReady(false);
      socket.close();
    };
  }, [token, wsServerUrl, filtersStr, onMessage]);

  return ready;
};

export default useWsClient;
