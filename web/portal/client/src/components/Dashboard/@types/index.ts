export interface DashboardClient {
  id: number;
  maxCalls: string;
  name: string;
  nif: string;
  postalCode: string;
  domainUsers: string;
}

export interface LastCall {
  startTime: string;
  caller: string;
  callee: string;
  duration: number;
}

export interface User {
  name: string;
  lastName: string;
  extension: string;
  outgoingDdi: string;
}

export interface RetailAccount {
  name: string;
  outgoingDdi: string;
  description: string;
}

export interface ResidentialDevices {
  name: string;
  outgoingDdi: string;
  description: string;
}

export interface DashboardData {
  client?: DashboardClient;
  latestBillableCalls?: LastCall[];
  latestUsers?: User[];
  latestResidentialDevices?: ResidentialDevices[];
  latestRetailAccounts?: RetailAccount[];
  userNum?: number;
  extensionNum?: number;
  ddiNum?: number;
  activeCallsNum?: number;
  residentialDeviceNum?: number;
  voiceMailNum?: number;
  retailsAccountNum?: number;
  productName?: string;
}

export interface CardFactoryProps {
  activeCalls?: ActiveCalls;
  data?: DashboardData;
}

export interface ActiveCalls {
  inbound: number;
  outbound: number;
  total: number;
}
