import TimelineIcon from '@mui/icons-material/Timeline';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { BalanceMovementProperties } from './BalanceMovementProperties';
import foreignKeyResolver from './ForeignKeyResolver';

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
  toStr: (row: any) => row.id,
  properties,
  columns: ['createdOn', 'amount', 'balance'],
  acl: {
    read: true,
    detail: false,
    create: true,
    update: false,
    delete: false,
  },
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default BalanceMovement;
