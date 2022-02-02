import { withRouter } from "react-router-dom";
import { Grid, styled, Theme } from "@mui/material";
import { StyledDashboardLink } from './Dashboard.styles';
import SettingsIcon from '@mui/icons-material/Settings';
import EntityMap from '../router/EntityMap';
import { RouteMapBlock, RouteMapItem } from "lib/router/routeMapParser";

interface DashboardProps {
    className?: string,
}

const DashboardLinks = (props: { items: RouteMapItem[] }): JSX.Element => {

    const { items } = props;

    return (
        <ul>
            {items.map((item: RouteMapItem, key: number) => {

                const { route, entity } = item;

                if (!entity) {
                    return null;
                }

                return (
                    <li key={key}>
                        <StyledDashboardLink to={route}>
                            {entity.icon}
                            {entity.title}
                        </StyledDashboardLink>
                    </li>
                );
            })}
        </ul>
    );
}

interface LinkBlockProps {
    routeMapBlock: RouteMapBlock
}
const DashboardBlock = (props: LinkBlockProps): JSX.Element => {

    const { label, children } = props.routeMapBlock;

    if (label) {
        return (
            <Grid item lg={4} md={6} xs={12}>
                <ul>
                    <li className="submenu">
                        <h3>
                            <SettingsIcon />
                            {label}
                        </h3>
                        <div>
                            <DashboardLinks items={children || []} />
                        </div>
                    </li>
                </ul>
            </Grid>
        );
    }

    return (
        <Grid item lg={4} md={6} xs={12}>
            <DashboardLinks items={children || []} />
        </Grid>
    );
}

const Dashboard = (props: DashboardProps) => {

    const { className } = props;

    return (
        <Grid container spacing={3} className={className}>
            {EntityMap.map((routeMapBlock: RouteMapBlock, key: number) => {
                return (
                    <DashboardBlock key={key} routeMapBlock={routeMapBlock} />
                );
            })}
        </Grid>
    );
};

export default withRouter<any, any>(
    styled(Dashboard)(
        ({ theme }: { theme: Theme }) => {
            return {
                [theme.breakpoints.down('md')]: {
                    '& ul': {
                        'paddingInlineStart': '20px',
                    },
                    '& ul li.submenu li': {
                        'paddingInlineStart': '40px',
                    },
                }
            };
        }
    )
);