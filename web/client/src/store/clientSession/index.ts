import recordLocutionService, { RecordLocutionServiceStore } from './recordLocutionService';
import Acls, { AclsStore } from './acls';

export interface ClientSessionStore {
  recordLocutionService: RecordLocutionServiceStore,
  acls: AclsStore,
}

const clientSession: ClientSessionStore = {
  recordLocutionService,
  acls: Acls
}

export default clientSession;