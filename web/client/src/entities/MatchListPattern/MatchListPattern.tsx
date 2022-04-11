import FormatListNumberedIcon from '@mui/icons-material/FormatListNumbered';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter'
import { PartialPropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import foreignKeyResolver from './foreignKeyResolver';
import selectOptions from './SelectOptions';
import matchValue from './Field/MatchValue';

const properties: PartialPropertyList = {
    'matchList': {
        label: _('Match List'),
    },
    'description': {
        label: _('Description'),
    },
    'type': {
        label: _('Type'),
        'enum': {
            'number': _("Number"),
            'regexp': _("Regular Expression"),
        },
        'visualToggle': {
            'number': {
                show: ['numberCountry', 'numbervalue'],
                hide: ['regexp'],
            },
            'regexp': {
                show: ['regexp'],
                hide: ['numberCountry', 'numbervalue'],
            },
        },
    },
    'regexp': {
        label: _('Regular Expression'),
    },
    'numberCountry': {
        label: _('Country'),
    },
    'numbervalue': {
        label: _('Number'),
    },
    'matchValue': {
        label: _('Match Value'),
        component: matchValue,
    }
};

const columns = [
    'type',
    'matchValue',
    'description',
];

const matchListPattern: EntityInterface = {
    ...defaultEntityBehavior,
    icon: FormatListNumberedIcon,
    iden: 'MatchListPattern',
    title: _('Match List Pattern', { count: 2 }),
    path: '/match_list_patterns',
    properties,
    columns,
    acl: {
        ...defaultEntityBehavior.acl,
        iden: 'MatchListPatterns',
    },
    Form,
    foreignKeyGetter,
    foreignKeyResolver,
    selectOptions: (props, customProps) => { return selectOptions(props, customProps); },
};

export default matchListPattern;