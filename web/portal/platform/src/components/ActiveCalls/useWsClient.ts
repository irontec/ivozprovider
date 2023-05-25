import { useEffect, useState } from 'react';
import { useStoreState } from 'store';

type UseWsClientProps<T> = {
  wsServerUrl: string;
  onMessage: (data: T) => void;
};

const useWsClient = <T>(props: UseWsClientProps<T>): boolean => {
  const token = useStoreState((actions) => actions.auth.token);
  const { wsServerUrl, onMessage } = props;

  const [ready, setReady] = useState<boolean>(false);

  useEffect(() => {
    // console.log('init socket', wsServerUrl);
    const socket = new WebSocket(wsServerUrl);

    let retries = 0;
    const maxRetries = 5;
    let timeout: NodeJS.Timeout;

    function register() {
      const payload = {
        auth: token,
      };

      socket.send(JSON.stringify(payload));
    }

    socket.onmessage = function (event) {
      const payload = event.data;

      switch (payload) {
        case 'Challenge':
          if (retries >= maxRetries) {
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

      setReady(false);
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

      socket.close();
    };
  }, [token, wsServerUrl, onMessage]);

  return ready;
};

export default useWsClient;
