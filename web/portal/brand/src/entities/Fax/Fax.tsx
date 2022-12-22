import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { FaxProperties } from './FaxProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: FaxProperties = {
  name: {
    label: _('Name'),
  },
  email: {
    label: _('Email'),
  },
  sendByEmail: {
    label: _('Send ByEmail'),
  },
  id: {
    label: _('Id'),
  },
  company: {
    label: _('Company'),
  },
  outgoingDdi: {
    label: _('Outgoing Ddi'),
  },
};

const Fax: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Fax',
  title: _('Fax', { count: 2 }),
  path: '/faxes',
  toStr: (row: any) => row.name,
  properties,
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Fax;
