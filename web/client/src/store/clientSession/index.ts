import recordLocutionService, { RecordLocutionServiceStore } from './recordLocutionService';

export interface ClientSessionStore {
  recordLocutionService: RecordLocutionServiceStore,
}

const clientSession: ClientSessionStore = {
  recordLocutionService
}

export default clientSession;