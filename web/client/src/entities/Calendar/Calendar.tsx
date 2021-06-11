import * as React from 'react';
import SettingsApplications from '@material-ui/icons/SettingsApplications';
import EntityInterface, { PropertiesList } from 'entities/EntityInterface';
import _ from 'services/Translations/translate';
import defaultEntityBehavior from '../DefaultEntityBehavior';
import EntityService from 'services/Entity/EntityService';
import FormFieldFactory from 'services/Form/FormFieldFactory';
import { useFormikType } from 'services/Form/types';

const properties:PropertiesList = {
    'id': {
        label: 'id',
    },
    'name': {
        label: 'Name'
    },
};

const Form = (props: any) => {

    const { entityService, formik }: {entityService: EntityService, formik: useFormikType } = props;
    const formFieldFactory = new FormFieldFactory(entityService, formik);

    return (
        <React.Fragment>
            {formFieldFactory.getFormField('name')}
            <br />
        </React.Fragment>
    );
};

const calendar:EntityInterface = {
    ...defaultEntityBehavior,
    icon: <SettingsApplications />,
    iden: 'Calendar',
    title: _('Calendar', {count: 2}),
    path: '/calendars',
    properties,
    Form
};

export default calendar;