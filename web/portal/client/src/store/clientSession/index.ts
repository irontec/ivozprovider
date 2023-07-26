import aboutMe, { AboutMeStore } from './aboutMe';
import recordLocutionService, {
  RecordLocutionServiceStore,
} from './recordLocutionService';

export interface ClientSessionStore {
  recordLocutionService: RecordLocutionServiceStore;
  aboutMe: AboutMeStore;
}

const clientSession: ClientSessionStore = {
  recordLocutionService,
  aboutMe,
};

export default clientSession;
