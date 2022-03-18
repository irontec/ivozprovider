import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const edit = props.edit || false;
    const { entityService, row, match } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match
    });

    const interVpbxEdition = edit && row?.directConnectivity === 'intervpbx';
    const readOnlyProperties = {
        'directConnectivity': interVpbxEdition,
        'priority': interVpbxEdition,
        'description': interVpbxEdition,
    };

    const groups: Array<FieldsetGroups | false> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'directConnectivity',
                'priority',
                'description',
                'name',
                'password',
                'transport',
                'ip',
                'port',
                'alwaysApplyTransformations',
            ]
        },
        edit && !interVpbxEdition && {
            legend: _('Geographic Configuration'),
            fields: [
                'language',
                'transformationRuleSet',
            ]
        },
        edit && !interVpbxEdition && {
            legend: _('Outgoing Configuration'),
            fields: [
                'callAcl',
                'outgoingDdi',
            ]
        },
        !interVpbxEdition && {
            legend: _('Advanced Configuration'),
            fields: [
                edit && 'fromUser',
                edit && 'fromDomain',
                edit && 'allow',
                edit && 'ddiIn',
                edit && 't38Passthrough',
                edit && 'rtpEncryption',
                'multiContact',
            ]
        },
        {
            legend: '',
            fields: [
                edit && 'statusIcon',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} readOnlyProperties={readOnlyProperties} />);
}

export default Form;