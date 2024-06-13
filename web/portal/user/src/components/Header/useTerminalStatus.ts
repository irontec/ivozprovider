import { useStoreState } from 'store';

import { Status } from '../../store/userStatus/status';

const useTerminalStatus = (): Status => {
  const profile = useStoreState((state) => state.userStatus.status.profile);

  const defaultValues = {
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
    features: [],
  } as Status;

  if (profile) {
    return profile;
  }

  return defaultValues;
};

export default useTerminalStatus;
