import DefaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CellTowerIcon from '@mui/icons-material/CellTower';
import { ActiveCallProperties } from './ActiveCallsProperties';

const properties: ActiveCallProperties = {};

const activeCalls: EntityInterface = {
  ...DefaultEntityBehavior,
  icon: CellTowerIcon,
  iden: 'ActiveCalls',
  title: _('Active calls', { count: 2 }),
  path: '/active_calls',
  properties,
  acl: {
    create: false,
    read: true,
    detail: false,
    update: false,
    delete: false,
    iden: 'ActiveCalls',
  },
};

export default activeCalls;
