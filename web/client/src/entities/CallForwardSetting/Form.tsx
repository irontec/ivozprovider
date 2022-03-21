import useFkChoices from 'lib/entities/data/useFkChoices';
import defaultEntityBehavior, { EntityFormProps, FieldsetGroups } from 'lib/entities/DefaultEntityBehavior';
import { PropertyList } from 'lib/services/api/ParsedApiSpecInterface';
import { foreignKeyGetter } from './foreignKeyGetter';
import User from '../User/User';
import Friend from '../Friend/Friend';


const Form = (props: EntityFormProps): JSX.Element => {

    const { entityService, row, match, properties } = props;
    const DefaultEntityForm = defaultEntityBehavior.Form;
    const fkChoices = useFkChoices({
        foreignKeyGetter,
        entityService,
        row,
        match,
    });

    const newProperties = { ...properties };

    if (match.path.includes(User.path)) {
        delete newProperties.friend;
    } else if (match.path.includes(Friend.path)) {
        delete newProperties.user;
    }

    entityService.replaceProperties(newProperties as PropertyList);

    const groups: Array<FieldsetGroups> = [
        {
            legend: '',
            fields: [
                'enabled',
                'callTypeFilter',
                'callForwardType',
                'noAnswerTimeout',
                'targetType',
                'extension',
                'voicemail',
                'numberCountry',
                'numberValue',
                'cfwToretailAccount',
            ]
        },
    ];

    return (<DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />);
}

export default Form;