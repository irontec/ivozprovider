import { useEffect, useState } from 'react';
import { useStoreState } from 'store';

type UseWsClientProps<T> = {
  wsServerUrl: string;
  onMessage: (data: T) => void;
};

const useWsClient = <T>(props: UseWsClientProps<T>): boolean => {
  const token = useStoreState((actions: any) => actions.auth.token);
  const { wsServerUrl, onMessage } = props;

  const [ready, setReady] = useState<boolean>(false);

  useEffect(() => {
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
        console.log(
          `[ws close] Connection closed cleanly, code=${event.code} reason=${event.reason}`
        );
      } else {
        // e.g. server process killed or network down
        // event.code is usually 1006 in this case
        console.log('[ws close] Connection died');
      }

      setReady(false);
    };

    socket.onerror = function (error) {
      console.log(`[ws error]`, error);
      setReady(false);
    };

    return () => {
      if (timeout) {
        clearTimeout(timeout);
      }

      socket.close();
    };
  }, [token, wsServerUrl, onMessage]);

  return ready;
};

export default useWsClient;
