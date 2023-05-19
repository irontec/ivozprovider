import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import {
  InvoiceNumberSequenceProperties,
  InvoiceNumberSequencePropertyList,
} from './InvoiceNumberSequenceProperties';

const properties: InvoiceNumberSequenceProperties = {
  name: {
    label: _('Name'),
    maxLength: 40,
  },
  prefix: {
    label: _('Prefix'),
    maxLength: 20,
  },
  sequenceLength: {
    label: _('Sequence length'),
    default: 4,
    maximum: 10,
    minimum: 2,
  },
  increment: {
    label: _('Increment'),
    default: 1,
    maximum: 10,
    minimum: 1,
  },
  latestValue: {
    label: _('Latest value'),
    readOnly: true,
  },
  iteration: {
    label: _('Iteration'),
    readOnly: true,
  },
  version: {
    label: _('Version'),
  },
};

const InvoiceNumberSequence: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'InvoiceNumberSequence',
  title: _('Invoice number sequence', { count: 2 }),
  path: '/invoice_number_sequences',
  toStr: (row: InvoiceNumberSequencePropertyList<EntityValues>) => `${row.id}`,
  properties,
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

export default InvoiceNumberSequence;
