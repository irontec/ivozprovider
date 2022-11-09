import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { MatchListProperties } from './MatchListProperties';
import foreignKeyResolver from './ForeignKeyResolver';

const properties: MatchListProperties = {
  name: {
    label: _('Name'),
  },
  id: {
    label: _('Id'),
  },
};

const MatchList: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'MatchList',
  title: _('Generic Match List', { count: 2 }),
  path: '/match_lists',
  toStr: (row: any) => row.name,
  properties,
  columns: ['name'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default MatchList;
