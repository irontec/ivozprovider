import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from 'entities/DefaultEntityBehavior';
import EntityService from 'services/Entity/EntityService';
import genericForeignKeyResolver from 'services/genericForeigKeyResolver';
import entities from '../index';
import Form from './Form';

const properties: PropertiesList = {
    service: {
        //@TODO Filter by current & unassigned
        label: _('Service'),
    },
    code: {
        label: _('Code'),
        prefix: (<span>*</span>),
        pattern: new RegExp('^[#0-9*]+$'),
        helpText: _('Allowed characters are 0-9, * and #')
    },
};

async function foreignKeyResolver(data: any, entityService: EntityService) {

    const promises = [];
    const { Service } = entities;

    promises.push(
        genericForeignKeyResolver(
            data,
            'service',
            Service.path,
            Service.toStr,
            false
        )
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
    Form
};

export default companyService;