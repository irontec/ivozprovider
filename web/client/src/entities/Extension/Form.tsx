import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ScalarProperty, PropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { ExtensionPropertyList } from './ExtensionProperties';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    let properties = props.properties;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices: ExtensionPropertyList<any> = useFkChoices({
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
            legend: '',
            fields: [
                'number',
            ]
        },
        {
            legend: '',
            fields: [
                'routeType',
                'ivr',
                'huntGroup',
                'conferenceRoom',
                'user',
                'numberCountry',
                'numberValue',
                'friendValue',
                'queue',
                'conditionalRoute',
                'voicemail',
            ]
        },
    ];

    return (
        <DefaultEntityForm
            {...props}
            fkChoices={fkChoices}
            groups={groups}
        />
    );
}

export default Form;