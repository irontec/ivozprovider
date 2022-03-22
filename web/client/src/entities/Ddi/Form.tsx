import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { PropertyList, ScalarProperty } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { DdiPropertyList } from './DdiProperties';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    let properties = props.properties;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices: DdiPropertyList<any> = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match,
    });

    let overwriteProperties = false;
    if (Object.keys(fkChoices).length) {

        const companyFeatures = Object
            .values(fkChoices.companyFeatures)
            .map((row: any) => row.iden);

        const routeType = {
            ...properties.routeType,
            enum: { ...(properties.routeType as ScalarProperty).enum },
        };
        const conditionalFeatures: Record<string, string> = {
            'queues': 'queue',
            'friends': 'friend',
            'faxes': 'fax',
            'conferences': 'conferenceRoom',
        };
        const conditionalFeaturesKeys = Object.keys(conditionalFeatures);

        for (const conditionalFeature of conditionalFeaturesKeys) {

            if (companyFeatures.includes(conditionalFeature)) {
                continue;
            }

            delete routeType.enum[conditionalFeatures[conditionalFeature]];
            overwriteProperties = true;
        }

        if (overwriteProperties) {
            properties = {
                ...props.properties,
                routeType
            };

            entityService.replaceProperties(properties as PropertyList);
        }
    }

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Number data'),
            fields: [
                'country',
                'ddi',
                'displayName',
                'language',
            ]
        },
        {
            legend: _('Filters data'),
            fields: [
                'externalCallFilter',
            ]
        },
        {
            legend: _('Routing configuration'),
            fields: [
                'routeType',
                'user',
                'fax',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'friendValue',
                'queue',
                'residentialDevice',
                'conditionalRoute',
                'retailAccount',
            ]
        },
        {
            legend: _('Recording data'),
            fields: [
                'recordCalls',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;