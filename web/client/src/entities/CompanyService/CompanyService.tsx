import MiscellaneousServicesIcon from '@mui/icons-material/MiscellaneousServices';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import Form from './Form';
import { foreignKeyGetter } from './foreignKeyGetter';
import { CompanyServiceProperties } from './CompanyServiceProperties';
import foreignKeyResolver from './foreignKeyResolver';

const properties: CompanyServiceProperties = {
    service: {
        label: _('Service'),
    },
    code: {
        label: _('Code'),
        prefix: (<span>*</span>),
        pattern: new RegExp('^[#0-9*]+$'),
        helpText: _('Allowed characters are 0-9, * and #')
    },
};

const columns = [
    'service',
    'code',
];

const companyService: EntityInterface = {
    ...defaultEntityBehavior,
    icon: MiscellaneousServicesIcon,
    iden: 'CompanyService',
    title: _('Service', { count: 2 }),
    path: '/company_services',
    properties,
    columns,
    foreignKeyResolver,
    Form,
    foreignKeyGetter
};

export default companyService;