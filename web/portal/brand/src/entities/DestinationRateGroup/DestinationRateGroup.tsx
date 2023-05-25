import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import PointOfSaleIcon from '@mui/icons-material/PointOfSale';

import {
  DestinationRateGroupProperties,
  DestinationRateGroupPropertyList,
} from './DestinationRateGroupProperties';

const properties: DestinationRateGroupProperties = {
  status: {
    label: _('Status'),
    enum: {
      waiting: _('Waiting'),
      inProgress: _('In Progress'),
      imported: _('Imported'),
      error: _('Error'),
    },
    //@TODO IvozProvider_Klear_Ghost_DestinationRateGroups::getStatus
  },
  lastExecutionError: {
    label: _('Last execution error'),
  },
  deductibleConnectionFee: {
    label: _('Deductible Connection Fee'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      `Apply connect fee only if call cost does not reach connect fee (minimal cost, read documentation for further information).`
    ),
  },
  name: {
    label: _('Name'),
    maxLength: 55,
    multilang: true,
  },
  description: {
    label: _('Description'),
    maxLength: 255,
    multilang: true,
  },
  file: {
    label: _('Imported file'),
    type: 'file',
  },
  currency: {
    label: _('Currency', { count: 1 }),
    null: _('Default currency'),
  },
};

const DestinationRateGroup: EntityInterface = {
  ...defaultEntityBehavior,
  icon: PointOfSaleIcon,
  iden: 'DestinationRateGroup',
  title: _('Destination rate', { count: 2 }),
  path: '/destination_rate_groups',
  toStr: (row: DestinationRateGroupPropertyList<EntityValues>) =>
    `${row.name?.en}`,
  properties,
  columns: ['name', 'description', 'currency', 'file', 'status'],
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

export default DestinationRateGroup;
