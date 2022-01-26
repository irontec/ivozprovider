import SettingsApplications from '@mui/icons-material/SettingsApplications';
import EntityInterface from 'lib/entities/EntityInterface';
import _ from 'lib/services/translations/translate';
import defaultEntityBehavior from 'lib/entities/DefaultEntityBehavior';
import genericForeignKeyResolver from 'lib/services/api/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';
import { foreignKeyGetter } from './useFkChoices';
import { CompanyServiceProperties, CompanyServicePropertiesList } from './CompanyServiceProperties';

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

async function foreignKeyResolver(
    data: CompanyServicePropertiesList
): Promise<CompanyServicePropertiesList> {
    const promises = [];
    const { Service } = entities;

    promises.push(
        genericForeignKeyResolver({
            data,
            fkFld: 'service',
            entity: Service,
            addLink: false,
        })
    );

    await Promise.all(promises);

    return data;
}

const columns = [
    'service',
    'code',
];

const companyService: EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
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