import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { PropertyList, ScalarProperty } from 'lib/services/api/ParsedApiSpecInterface';
import _ from 'lib/services/translations/translate';
import { ConditionalRoutePropertyList } from './ConditionalRouteProperties';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    let properties = props.properties;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices: ConditionalRoutePropertyList<any> = useFkChoices({
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

        const routetype = {
            ...properties.routetype,
            enum: { ...(properties.routetype as ScalarProperty).enum },
        };
        const conditionalFeatures: Record<string, string> = {
            'queues': 'queue',
            'friends': 'friend',
            'conferences': 'conferenceRoom',
        };
        const conditionalFeaturesKeys = Object.keys(conditionalFeatures);

        for (const conditionalFeature of conditionalFeaturesKeys) {

            if (companyFeatures.includes(conditionalFeature)) {
                continue;
            }

            delete routetype.enum[conditionalFeatures[conditionalFeature]];
            overwriteProperties = true;
        }

        if (overwriteProperties) {
            properties = {
                ...props.properties,
                routetype
            };

            entityService.replaceProperties(properties as PropertyList);
        }
    }

    const groups: Array<FieldsetGroups> = [
        {
            legend: _('Basic Configuration'),
            fields: [
                'name',
            ]
        },
        {
            legend: _('No matching condition handler'),
            fields: [
                'locution',
                'routetype',
                'ivr',
                'huntGroup',
                'voicemail',
                'user',
                'numberCountry',
                'numbervalue',
                'friendvalue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;