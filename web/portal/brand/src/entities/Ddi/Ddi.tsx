import AccountTreeIcon from '@mui/icons-material/AccountTree';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { DdiProperties } from './DdiProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: DdiProperties = {
  'ddi': {
    label: _('Ddi'),
  },
  'ddie164': {
    label: _('Ddie 164'),
  },
  'id': {
    label: _('Id'),
  },
  'company': {
    label: _('Company'),
  },
  'ddiProvider': {
    label: _('Ddi Provider'),
  },
  'country': {
    label: _('Country'),
  },
};

const Ddi: EntityInterface = {
  ...defaultEntityBehavior,
  icon: AccountTreeIcon,
  iden: 'Ddi',
  title: _('Ddi', { count: 2 }),
  path: '/Ddis',
  toStr: (row: any) => row.id,
  properties,
  selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default Ddi;