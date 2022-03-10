import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { PropertyList, ScalarProperty } from 'lib/services/api/ParsedApiSpecInterface';
import _ from 'lib/services/translations/translate';
import { ConditionalRoutesConditionPropertyList } from './ConditionalRoutesConditionProperties';
import { foreignKeyGetter } from './foreignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match } = props;
    let { properties } = props;

    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices: ConditionalRoutesConditionPropertyList<any> = useFkChoices({
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
            legend: _('Matching priority'),
            fields: [
                'priority',
            ]
        },
        {
            legend: _('Matching type'),
            fields: [
                'matchListIds',
                'routeLockIds',
                'scheduleIds',
                'calendarIds',
            ]
        },
        {
            legend: _('Matching handler'),
            fields: [
                'locution',
                'routeType',
                'numberCountry',
                'numberValue',
                'ivr',
                'user',
                'huntGroup',
                'voicemail',
                'friendValue',
                'queue',
                'conferenceRoom',
                'extension',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;