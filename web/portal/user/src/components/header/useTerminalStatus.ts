import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

interface SharedAttr {
  companyDomain: string;
  companyName: string;
  extensionNumber: string;
  gsQRCode: boolean;
  ipRegistered: string;
  language: string;
  terminalName: string;
  terminalPassword: string;
  userAgent: string;
  userName: string;
  voiceMail: string;
}

interface Status extends SharedAttr {
  registered: boolean | null;
}

interface ApiResponse extends SharedAttr {
  statusTerminal: boolean | null;
}

const useTerminalStatus = (): Status => {
  const apiGet = useStoreActions((store) => store.api.get);

  const [status, setStatus] = useState<Status>({
    companyDomain: '',
    companyName: '',
    extensionNumber: '',
    gsQRCode: false,
    ipRegistered: '',
    language: '',
    terminalName: '',
    terminalPassword: '',
    userAgent: '',
    userName: '',
    voiceMail: '',
    registered: false,
  });

  useEffect(() => {
    const statusReq = () => {
      apiGet({
        path: '/my/status',
        params: {},
        successCallback: async (data) => {
          const input = data as ApiResponse;

          const response: Status = {
            ...input,
            registered: input.statusTerminal,
          };

          setStatus(response);
        },
      });
    };

    statusReq();

    const interval = setInterval(statusReq, 5000);

    return () => {
      clearInterval(interval);
    };
  }, [apiGet]);

  return status;
};

export default useTerminalStatus;
