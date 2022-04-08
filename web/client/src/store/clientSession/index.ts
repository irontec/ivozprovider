import recordLocutionService, { RecordLocutionServiceStore } from './recordLocutionService';
import aboutMe, { AboutMeStore } from './aboutMe';

export interface ClientSessionStore {
  recordLocutionService: RecordLocutionServiceStore,
  aboutMe: AboutMeStore,
}

const clientSession: ClientSessionStore = {
  recordLocutionService,
  aboutMe
}

export default clientSession;