export type Direction = 'outbound' | 'inbound';
export type Events =
  | 'Trying'
  | 'Proceeding' //Connect
  | 'Early' //Ringing
  | 'Confirmed' //Answered
  | 'Terminated' // Hangup
  | 'UpdateCLID'; // Info update

export interface TryingStuct {
  ID: string;
  'Call-ID': string;
  Brand: string;
  Company: string;
  Direction: Direction;
  Event: Events;
  Owner: string;
  Party: string;
  Caller: string;
  Callee: string;
  Carrier?: string;
  DdiProvider?: string;
  Time: number;
}

export interface UpdateStuct {
  ID?: string;
  'Call-ID': string;
  Event: Events;
  Party: string;
  Time: number;
}

export type InputStruct = TryingStuct | UpdateStuct;

export const isTryingStruct = (
  data: TryingStuct | UpdateStuct
): data is TryingStuct => {
  return (data as TryingStuct).Brand !== undefined;
};

export const isUpdateStruct = (
  data: TryingStuct | UpdateStuct
): data is UpdateStuct => {
  return (data as TryingStuct).Brand === undefined;
};

export interface OutputStuct {
  id: string;
  callId: string;
  direction: Direction;
  event: Events;
  time: number;
  duration: string;
  brand: string;
  company: string;
  caller: string;
  callee: string;
  operator: string;
  party?: string;
}

export type Calls = { [key: string]: OutputStuct };
