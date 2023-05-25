import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import TimelineIcon from '@mui/icons-material/Timeline';

import {
  BalanceMovementProperties,
  BalanceMovementPropertyList,
} from './BalanceMovementProperties';

const properties: BalanceMovementProperties = {
  amount: {
    label: _('Movement amount'),
    //@TODO IvozProvider_Klear_Ghost_BalanceMovements::getAmount
  },
  balance: {
    label: _('Balance'),
    //@TODO IvozProvider_Klear_Ghost_BalanceMovements::getBalance
  },
  createdOn: {
    label: _('Created'),
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Client'),
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
  },
};

const BalanceMovement: EntityInterface = {
  ...defaultEntityBehavior,
  icon: TimelineIcon,
  iden: 'BalanceMovement',
  title: _('Balance Movement', { count: 2 }),
  path: '/balance_movements',
  toStr: (row: BalanceMovementPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: ['createdOn', 'amount', 'balance'],
  acl: {
    read: true,
    detail: false,
    create: false,
    update: false,
    delete: false,
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default BalanceMovement;
