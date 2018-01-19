var Notification = React.createClass({
    getInitialState: function() {
        return {
            pop: true,
            data: [],
            count: 0
        };
    },
    componentWillMount() {
       this.getNotification();
    },
    componentDidMount() {
        setInterval( () => {
                    this.getNotification();
                },
                3000
        );
    },
    popupList: function(event) {
        if (this.state.pop) {
            $('.list-items').show();
            this.setState({
                pop: false
            });
        } else {
            $('.list-items').hide();
            $.ajax({
                url: "/admin/notification/not-active",
                type: "POST"
            });
            this.setState({
                pop: true,
                count: 0
            });
            localStorage.removeItem('notice');
        }
    },
    getNotification: function() {
        $.ajax({
            url: "/admin/notification/index",
            type: "POST",
            dataType: "json",
            success: $.proxy(function(data) {
                if (!$.isEmptyObject(data)) {
                    var count = data['active'].length;
                    if (count > 0) {
                        var notice = document.getElementById('notice');
                        if (localStorage.getItem('notice') === null) {
                            notice.play();
                            localStorage.setItem('notice', data['active'].length);
                        }

                        if (data['active'].length > localStorage.getItem('notice')) {
                            localStorage.setItem('notice', data['active'].length);
                            notice.play();
                        }
                    }
                } else {
                    var count = this.state.count;
                }
                this.setState({
                    data: data,
                    count: count
                });
            }, this)
        });
    },
    shouldComponentUpdate: function(nextProps, nextState) {
        if (!$.isEmptyObject(this.state.data)) {
            if (this.state.data['active'].length === nextState.data['active'].length && this.state.count === nextState.count) {
                return false;
            }
        }
        return true;
    },
    render: function() {
        return (
            <div>
                <div className="notification" onClick={this.popupList}>
                    <i className="fa fa-bell" aria-hidden="true"></i>
                    <Counter count={this.state.count} />
                </div>
                <ListItems data={this.state.data} />
            </div>
        );
    }
});

var ListItems = React.createClass({
    render: function() {
        if (!$.isEmptyObject(this.props.data)) {
            return (
                <div className="list-items">
                    <div className="arrow"></div>
                    {
                        this.props.data['active'].map(function(el){
                            return <Item styles="item active" key={el.id} name={el.name} link={el.link} date={el.date} />;
                        })
                    }
                    {
                        this.props.data['noActive'].map(function(el){
                            return <Item styles="item" key={el.id} name={el.name} link={el.link} date={el.date} />;
                        })
                    }
                </div>
            );
        } else {
            return (
                <div className="list-items">
                    {
                        <div className="item">
                            <h1 className="empty-list">У Вас ничего нет!</h1>
                        </div>
                    }
                </div>
            );
        }
    }
});

var Item = React.createClass({
    render: function() {
        return (
            <div className={this.props.styles}>
                <a href={this.props.link}>
                    <h1>{this.props.name}</h1>
                    <p className="date">{this.props.date}</p>
                </a>
            </div>
        );
    }
});

var Counter = React.createClass({
    render: function() {
        if (this.props.count > 0) {
            return (
                <div className="counter">
                    <span>{this.props.count}</span>
                </div>
            );
        }
        return false;
    }
});

ReactDOM.render(
    <Notification />,
    document.getElementById('wrap-notification')
);