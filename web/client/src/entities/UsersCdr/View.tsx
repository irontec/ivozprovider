import defaultEntityBehavior, { FieldsetGroups } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { ViewProps } from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const View = (props: ViewProps): JSX.Element | null => {

    const groups: Array<FieldsetGroups | false> = [
        {
            legend: _('Call Details'),
            fields: [
                'startTime',
                'duration',
                'owner',
                'direction',
                'party',
            ]
        }
    ];

    return (<defaultEntityBehavior.View {...props} groups={groups} />);
}

export default View;