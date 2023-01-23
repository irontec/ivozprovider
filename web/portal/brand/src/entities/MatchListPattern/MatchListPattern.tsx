import FormatListBulletedIcon from '@mui/icons-material/FormatListBulleted';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { MatchListPatternProperties } from './MatchListPatternProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import MatchValue from './Field/MatchValue';

const properties: MatchListPatternProperties = {
  description: {
    label: _('Description'),
  },
  type: {
    label: _('Type'),
    enum: {
      number: _('Number'),
      regexp: _('Regular Expression'),
    },
    visualToggle: {
      number: {
        show: ['numberCountry', 'numbervalue'],
        hide: ['regexp'],
      },
      regexp: {
        show: ['regexp'],
        hide: ['numberCountry', 'numbervalue'],
      },
    },
  },
  regexp: {
    label: _('Regular Expression'),
    helpText: _(
      'Enter number patterns in E.164 format (plus symbol must be escaped).'
    ),
  },
  numbervalue: {
    label: _('Number'),
  },
  id: {
    label: _('Id'),
  },
  matchList: {
    label: _('Match List'),
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
  },
  matchValue: {
    label: _('Match value'),
    component: MatchValue,
  },
};

const MatchListPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListBulletedIcon,
  iden: 'MatchListPattern',
  title: _('Match List Pattern', { count: 2 }),
  path: '/match_list_patterns',
  toStr: (row: any) => row.id,
  properties,
  columns: ['type', 'matchValue', 'description'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default MatchListPattern;
