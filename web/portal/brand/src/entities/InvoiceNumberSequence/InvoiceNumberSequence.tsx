import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { InvoiceNumberSequenceProperties } from './InvoiceNumberSequenceProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: InvoiceNumberSequenceProperties = {
  'name': {
    label: _('Name'),
  },
  'prefix': {
    label: _('Prefix'),
  },
  'sequenceLength': {
    label: _('Sequence Length'),
  },
  'increment': {
    label: _('Increment'),
  },
  'latestValue': {
    label: _('Latest Value'),
  },
  'iteration': {
    label: _('Iteration'),
  },
  'version': {
    label: _('Version'),
  },
  'id': {
    label: _('Id'),
  },
};

const InvoiceNumberSequence: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'InvoiceNumberSequence',
  title: _('InvoiceNumberSequence', { count: 2 }),
  path: '/InvoiceNumberSequences',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default InvoiceNumberSequence;