import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';

import matchValue from './Field/MatchValue';

const properties: PartialPropertyList = {
  matchList: {
    label: _('Match List', { count: 1 }),
  },
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
  },
  numberCountry: {
    label: _('Country', { count: 1 }),
  },
  numbervalue: {
    label: _('Number'),
  },
  matchValue: {
    label: _('Match Value'),
    component: matchValue,
  },
};

const columns = ['type', 'matchValue', 'description'];

const MatchListPattern: EntityInterface = {
  ...defaultEntityBehavior,
  icon: FormatListNumberedIcon,
  iden: 'MatchListPattern',
  title: _('Match List Pattern', { count: 2 }),
  path: '/match_list_patterns',
  properties,
  columns,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'MatchListPatterns',
  },
  calculateAclByParentRow: (acl, parentRow) => {
    if (parentRow.generic === true) {
      acl.detail = false;
      acl.create = false;
      acl.update = false;
      acl.delete = false;
    }

    return acl;
  },
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default MatchListPattern;
