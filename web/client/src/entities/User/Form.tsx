import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import _ from 'lib/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match,
    });

    const edit = props.edit || false;
    const groups: Array<FieldsetGroups | false> = [
        {
            legend: _('Personal data'),
            fields: [
                'name',
                'lastname',
                'email',
            ]
        },
        edit && {
            legend: _('Geographic Configuration'),
            fields: [
                edit && 'language',
                'timezone',
                'transformationRuleSet',
            ]
        },
        edit && {
            legend: _('Login Info'),
            fields: [
                'active',
                'pass',
                'gsQRCode',
            ]
        },
        edit && {
            legend: _('Boss-Assistant'),
            fields: [
                'isBoss',
                'bossAssistant',
                'bossAssistantWhiteList',
            ]
        },
        {
            legend: _('Basic Configuration'),
            fields: [
                'terminal',
                'extension',
                'outgoingDdi',
                'outgoingDdiRule',
                edit && 'callAcl',
                edit && 'doNotDisturb',
                edit && 'maxCalls',
                edit && 'externalIpCalls',
                edit && 'multiContact',
                edit && 'rejectCallMethod',
            ]
        },
        edit && {
            legend: _('Boss-Assistant'),
            fields: [
                'isBoss',
                'bossAssistant',
                'bossAssistantWhiteList',
            ]
        },
        edit && {
            legend: _('Group belonging'),
            fields: [
                'pickupGroupIds',
                //@TODO 'HuntGroupsRelUsers',
            ]
        }
    ];

    return (
        <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />
    );
}

export default Form;
